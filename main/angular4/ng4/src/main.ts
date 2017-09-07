/*!
 *
 * Dasha - Bootstrap Admin Template
 *
 * Version: 1.0.0
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: https://wrapbootstrap.com/help/licenses
 *
 */

import './modernizr.js'; // 'npm run modernizr' to create this file;

import { enableProdMode } from '@angular/core';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';

import { AppModule } from './app/app.module';
import { environment } from './environments/environment';

if (environment.production) {
  enableProdMode();
}

platformBrowserDynamic().bootstrapModule(AppModule)
    .then(() => { (<any>window).appBootstrap && (<any>window).appBootstrap(); })
    // .catch(err => console.error(err));
