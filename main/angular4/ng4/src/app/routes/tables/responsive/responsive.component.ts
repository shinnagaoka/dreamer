import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-responsive',
    templateUrl: './responsive.component.html',
    styleUrls: ['./responsive.component.scss']
})
export class ResponsiveComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Responsive Tables');
    }

    ngOnInit() {
    }

}
