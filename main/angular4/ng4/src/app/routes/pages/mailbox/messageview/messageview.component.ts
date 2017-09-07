import { Component, OnInit, ViewChild } from '@angular/core';
import { ModalDirective } from 'ngx-bootstrap';

@Component({
    selector: 'app-messageview',
    templateUrl: './messageview.component.html',
    styleUrls: ['./messageview.component.scss']
})
export class MessageviewComponent implements OnInit {

    @ViewChild('msgViewModal') public msgViewModal: ModalDirective;

    constructor() { }

    ngOnInit() {
    }
}
