import { Component, OnInit } from '@angular/core';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-mailbox',
    templateUrl: './mailbox.component.html',
    styleUrls: ['./mailbox.component.scss']
})
export class MailboxComponent implements OnInit {

    constructor(pt: PagetitleService) {
        pt.setTitle('Mailbox');
    }

    ngOnInit() {
    }

}
