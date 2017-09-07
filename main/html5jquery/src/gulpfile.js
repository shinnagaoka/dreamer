var $ = require('gulp-load-plugins')(),
    gulp = require('gulp'),
    fs = require('fs'),
    path = require('path'),
    args = require('yargs').argv,
    del = require('del'),
    globby = require('globby'),
    gulpsync = $.sync(gulp),
    PluginError = $.util.PluginError,
    browserSync = require('browser-sync').create(),
    pify = require('pify'),
    stat = pify(fs.stat),
    config = require('./gulp.config');


// Mode switches
// Example:
//    gulp --useless --usesourcemaps

var useSourceMaps = args.usesourcemaps || args.usesourcemap;
var useLess = !!args.useless;

// production mode (--prod)
var isProduction = !!args.prod;

if (isProduction)
    log('Running for production...');

// switch to less
if (useLess) {

    log('Using LESS stylesheets...');

    config.source.styles.app = [
        config.paths.app + 'app.less',
        config.paths.components + '**/*.less'
    ];

}

// Helps to detect changes in layout or templates
// included from other files and ignore gulp-changed
// (see tasks 'templates:views' and 'watch')
var isLayoutOrTpl = false;

//---------------
// TASKS
//---------------

// JS
gulp.task('scripts', ['scripts:validate'], function() {
    return gulp.src(config.source.scripts)
        .pipe($.if(isProduction, $.uglify(config.uglify)))
        .on('error', handleError)
        .pipe($.concat('app.js'))
        .pipe(gulp.dest(config.build.scripts));
});

gulp.task('scripts:validate', function() {
    return gulp.src(config.source.scripts)
        .pipe($.jsvalidate())
        .on('error', handleError);
});


// APP LESS
gulp.task('styles:app', function() {
    log('Building application styles..');
    return gulp.src(config.source.styles.app)
        .pipe($.if(useSourceMaps, $.sourcemaps.init()))
        .pipe(useLess ? $.less() : $.sass())
        .on('error', handleError)
        .pipe($.clipEmptyFiles())
        //.pipe($.sort())
        .pipe($.concat('app.css'))
        .pipe($.if(isProduction, $.cleanCss()))
        .pipe($.if(useSourceMaps, $.sourcemaps.write()))
        .pipe(gulp.dest(config.build.styles))
        .pipe(browserSync.stream())

});

// APP RTL
gulp.task('styles:app:rtl', function() {
    log('Building application RTL styles..');
    return gulp.src(config.source.styles.app)
        .pipe($.if(useSourceMaps, $.sourcemaps.init()))
        .pipe(useLess ? $.less() : $.sass())
        .on('error', handleError)
        .pipe($.clipEmptyFiles())
        .pipe($.rtlcss()) /* RTL Magic ! */
        .pipe($.sort())
        .pipe($.concat('app-rtl.css'))
        .pipe($.if(isProduction, $.cleanCss()))
        .pipe($.if(useSourceMaps, $.sourcemaps.write()))
        .pipe(gulp.dest(config.build.styles))
        .pipe(browserSync.stream())

});

// VIEWS
gulp.task('templates:views', function() {
    log('Building views.. ');

    var pugFilter = $.filter('**/*.pug', {
        restore: true
    });

    return gulp.src(config.source.templates.views)
        .pipe($.if(!isProduction && !isLayoutOrTpl, $.changed(config.build.templates.views, {
            extension: '.html',
            hasChanged: fileHasChanged
        })))
        .on('error', handleError)
        .pipe(pugFilter)
        /*.pipe($.data(function() {
            return {
                scripts: globby.sync(config.source.scripts)
            };
        }))*/
        .pipe($.pug(config.pugOpts))
        .on('error', handleError)
        .pipe(pugFilter.restore)
        .pipe($.flatten())
        // useref is used only to copy files to vendor directory. Minification is done by task 'compress' for production
        .pipe($.useref({ noconcat: true, searchPath: '.' }))
        .on('error', handleError)
        .pipe($.tap(function(file, t) {
            if (['.js', '.css'].indexOf(file.extname) >= 0) {
                file.base = 'vendor';
            }
            return file;
        }))
        .pipe($.if('*.css', gulp.dest(config.build.vendor)))
        .pipe($.if('*.js', gulp.dest(config.build.vendor)))
        .pipe($.if('*.html', gulp.dest(config.build.templates.views)));
});

gulp.task('template:done', ['templates:views'], function(done) {
    browserSync.reload();
    done();
});

// Compress assets for production
gulp.task('compress', function() {
    log('Compressing vendor assets.. ');

    var assets = config.build.vendor + '/**/*.{css,js}';
    var jsFilter = $.filter(config.build.vendor + '/**/*.js', {
        restore: true
    });
    var cssFilter = $.filter(config.build.vendor + '/**/*.css', {
        restore: true
    });

    return gulp.src(assets)
        .pipe(cssFilter)
        .pipe($.cleanCss(config.cleanCss))
        .on('error', handleError)
        .pipe(cssFilter.restore)
        .pipe(jsFilter)
        .pipe($.uglify(config.uglifyVendor))
        .on('error', handleError)
        .pipe(jsFilter.restore)
        .pipe(gulp.dest(config.build.vendor));
});

// Images
gulp.task('images', function() {
    log('Copying images..');
    return gulp.src(config.source.images)
        .pipe(gulp.dest(config.build.images));
});

// Fonts
gulp.task('fonts', function() {
    log('Copying fonts..');
    return gulp.src(config.source.fonts)
        .pipe($.flatten())
        .pipe(gulp.dest(config.build.fonts));
});

// Copy static assets (json)
gulp.task('static', function() {
    log('Copying static assets (json)..');
    return gulp.src(config.source.static)
        .pipe(gulp.dest(config.build.static));
});

// Copy vendor assets
gulp.task('vendor', function() {
    log('Copying vendor assets..');
    return gulp.src(config.source.vendor, { base: config.paths.bower })
        .pipe(gulp.dest(config.build.vendor));
});

//---------------
// WATCH
//---------------

// Rerun the task when a file changes
gulp.task('watch', function() {
    log('Starting Watch..');

    // assets
    gulp.watch(config.source.images, ['images']);
    gulp.watch(config.source.fonts, ['fonts']);
    gulp.watch(config.source.static, ['static']);
    gulp.watch(config.source.vendor, ['vendor']);
    // code
    gulp.watch(config.source.scripts, gulpsync.sync(['scripts', 'reload']));
    gulp.watch(config.source.styles.app, ['styles:app' /*, 'styles:app:rtl'*/ ]);
    gulp.watch(config.source.templates.watch, ['template:done'])
        .on('change', function(file) {
            // Each time a pug file changes, check if layout or template
            // if so, activate flag to ignore changed control since we don't have
            // counterpart file to detect file time differences
            isLayoutOrTpl = false;
            var fname = path.basename(file.path);
            if (fname.indexOf('.layout.') > -1 || fname.indexOf('.tpl.') > -1)
                isLayoutOrTpl = true;
        });

});

gulp.task('reload', function(done) {
    browserSync.reload();
    done();
});

//---------------
// BROWSER SYNC
//---------------

// Rerun the task when a file changes
gulp.task('browsersync', function() {
    log('Starting BrowserSync..');

    browserSync.init({
        notify: false,
        server: {
            baseDir: '..'
        }
    });

});


//---------------
// LINT
//---------------

gulp.task('lint', function() {
    return gulp
        .src(config.source.scripts)
        .pipe($.jshint())
        .pipe($.jshint.reporter('jshint-stylish', {
            verbose: true
        }))
        .pipe($.jshint.reporter('fail'));
});

//---------------
// CLEAN
//---------------

// Remove dist folder
gulp.task('clean', function(done) {
    var deletePaths = [].concat(
        config.paths.dist
    );

    clean(deletePaths, done);
});

//---------------
// MAIN TASKS
//---------------

// build for development (no minify)
gulp.task('default', gulpsync.sync([
    'build',
    'watch'
]), done);

// Server for development
gulp.task('serve', gulpsync.sync([
    'build',
    'watch',
    'browsersync'
]), done);

var buildTasks = [
    'scripts',
    'styles:app',
    //'styles:app:rtl',
    'templates:views',
    'images',
    'static',
    'vendor'
];

if (isProduction)
    buildTasks.push('compress');

// build tasks
gulp.task('build', gulpsync.sync(buildTasks));


/////////////////////

// Error handler
function handleError(err) {
    log(err.toString());
    this.emit('end');
}

// log to console using
function log(msg) {
    $.util.log($.util.colors.blue(msg));
}

// a simple message
function done() {
    log('********');
    log('* Done * Watching files to recompile..');
    log('********');
}

// remove folders
function clean(paths, done) {
    log('Cleaning: ' + $.util.colors.blue(paths));
    // force: clean files outside current directory
    del(paths, {
        force: true
    }, done);
}

// We are using a different folder structure in source and destiny.
// with this function we compare each file time to
// detect what have changed no matter their location
// (Compares one by one -> pug vs html)
function fileHasChanged(stream, sourceFile, destPath) {
    var destPathTo = config.build.templates.views;
    var modDestPath = destPathTo + path.basename(destPath);

    return stat(modDestPath)
        .then(function(targetStat) {
            if (sourceFile.stat.mtime > targetStat.mtime) {
                stream.push(sourceFile);
            }
        });
};