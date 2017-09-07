import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-icons',
    templateUrl: './icons.component.html',
    styleUrls: ['./icons.component.scss']
})
export class IconsComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Icons');
    }

    ngOnInit() {
    }

}
