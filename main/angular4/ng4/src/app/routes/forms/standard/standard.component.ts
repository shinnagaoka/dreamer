import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-standard',
    templateUrl: './standard.component.html',
    styleUrls: ['./standard.component.scss']
})
export class StandardComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Standard Inputs');
    }

    ngOnInit() {
    }

}
