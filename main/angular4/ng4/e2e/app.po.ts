import { browser, by, element } from 'protractor';

export class Ng4Page {
    navigateTo() {
        return browser.get('/');
    }

    getRootElement() {
        return element.all(by.css('app-root'));
    }
}
