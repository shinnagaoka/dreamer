import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ToasterService, ToasterConfig } from 'angular2-toaster';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-toaster',
    templateUrl: './toaster.component.html',
    styleUrls: ['./toaster.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class ToasterComponent {

    public toasterConfig: ToasterConfig = new ToasterConfig({
        positionClass: 'toast-top-right'
    });

    constructor(private toasterService: ToasterService, pt: PagetitleService) {
        pt.setTitle('Toastr');
    }

    showToaster(type, positionClass) {
        this.toasterConfig.positionClass = positionClass;
        this.toasterService.pop(type, '', 'My name is Inigo Montoya. You killed my father, prepare to die!');
    }

    clearAll() {
        this.toasterService.clear();
    }

}
