import { Component, ViewEncapsulation, OnInit } from '@angular/core';
declare var $: any;

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class AppComponent implements OnInit {
    ngOnInit() {
        // prevent empty links to reload page
        $(document).on('click', 'a[href="#"]', (e) => e.preventDefault());
    }
}
