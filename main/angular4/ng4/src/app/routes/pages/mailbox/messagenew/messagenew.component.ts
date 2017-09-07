import { Component, OnInit, ViewChild } from '@angular/core';
import { ModalDirective } from 'ngx-bootstrap';

@Component({
    selector: 'app-messagenew',
    templateUrl: './messagenew.component.html',
    styleUrls: ['./messagenew.component.scss']
})
export class MessagenewComponent implements OnInit {

    @ViewChild('msgNewModal') public msgNewModal: ModalDirective;

    constructor() { }

    ngOnInit() {
    }

}
