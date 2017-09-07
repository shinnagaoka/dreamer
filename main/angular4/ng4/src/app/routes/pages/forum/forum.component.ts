import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-forum',
    templateUrl: './forum.component.html',
    styleUrls: ['./forum.component.scss']
})
export class ForumComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Forum');
    }

    ngOnInit() {
    }

}
