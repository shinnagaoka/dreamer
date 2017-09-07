import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-gridmasonry',
    templateUrl: './gridmasonry.component.html',
    styleUrls: ['./gridmasonry.component.scss']
})
export class GridmasonryComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Grid Masonry');
    }

    ngOnInit() {
    }

}
