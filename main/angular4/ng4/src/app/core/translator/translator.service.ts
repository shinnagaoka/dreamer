import { Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Injectable()
export class TranslatorService {

    defaultLanguage: string = 'en';
    availablelangs: any;
    currentLang: string = this.defaultLanguage;

    constructor(private translate: TranslateService) {
        // this language will be used as a fallback when a translation isn't found in the current language
        translate.setDefaultLang(this.defaultLanguage);

        this.availablelangs = [
            { code: 'en', text: 'English' },
            { code: 'es', text: 'Spanish' },
            { code: 'fr', text: 'French' }
        ];

        this.useLanguage();

    }

    useLanguage(lang: string = this.defaultLanguage) {
        this.translate.use(lang);
        this.currentLang = lang;
    }

    getAvailableLanguages() {
        return this.availablelangs;
    }

    getCurrentLang() {
        for(let i in this.availablelangs) {
            if(this.availablelangs[i].code === this.currentLang) {
                return this.availablelangs[i].text;
            }
        }
    }

}
