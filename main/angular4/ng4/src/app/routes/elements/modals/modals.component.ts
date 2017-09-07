import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-modals',
    templateUrl: './modals.component.html',
    styleUrls: ['./modals.component.scss']
})
export class ModalsComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Modals');
    }

    ngOnInit() {
    }

}
