import { Ng4Page } from './app.po';
import { browser } from 'protractor';

describe('ng4 App', () => {
    let page: Ng4Page;
    browser.ignoreSynchronization = true;

    beforeEach(() => {
        page = new Ng4Page();
    });

    it('should perform a basic test', () => {
        page.navigateTo();
        let root = page.getRootElement();
        expect(root.count()).toEqual(1);
    });

});
