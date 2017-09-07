import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { ModalDirective } from 'ngx-bootstrap';

const screenfull = require('screenfull');
declare var $: any;

import { SettingsService } from '../../shared/settings/settings.service';
import { TranslatorService } from '../../core/translator/translator.service';

@Component({
    selector: 'app-settings',
    templateUrl: './settings.component.html',
    styleUrls: ['./settings.component.scss']
})
export class SettingsComponent implements OnInit {

    @ViewChild('fsbutton') fsbutton;
    @ViewChild('settingsModal') public settingsModal: ModalDirective;

    public selectedTheme = 'theme-default';
    public selectedLanguage = 'en';

    constructor(public settings: SettingsService, public translator: TranslatorService) { }

    ngOnInit() { }

    updateTheme() {
        this.settings.setSetting('theme', this.selectedTheme);
        $('body')
            .removeClass((index, css) => (css.match(/(^|\s)theme-\S+/g) || []).join(' '))
            .addClass(this.settings.getSetting('theme'));
    }

    toggleFullScreen() {

        if (screenfull.enabled) {
            screenfull.toggle();
        }

    }

}
