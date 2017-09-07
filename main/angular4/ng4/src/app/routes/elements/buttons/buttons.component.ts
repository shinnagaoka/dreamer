import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-buttons',
    templateUrl: './buttons.component.html',
    styleUrls: ['./buttons.component.scss']
})
export class ButtonsComponent implements OnInit {

    disabled;

    constructor(pt: PagetitleService) {
        pt.setTitle('Buttons');
    }

    ngOnInit() {
    }

}
