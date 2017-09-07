import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Http } from '@angular/http';

import { PagetitleService } from '../../../core/pagetitle/pagetitle.service';

@Component({
    selector: 'app-datatables',
    templateUrl: './datatables.component.html',
    styleUrls: ['./datatables.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class DatatablesComponent implements OnInit {

    public data = [];
    public filterQuery = '';
    public rowsOnPage = 10;
    public sortBy = 'email';
    public sortOrder = 'asc';

    constructor(pt: PagetitleService, private http: Http) {
        pt.setTitle('Data Table');
    }

    ngOnInit(): void {
        this.http.get('assets/static/datatable.json').subscribe((data) => this.data = data.json());
    }

    public toInt(num: string) {
        return +num;
    }

    public sortByWordLength = (a: any) => {
        return a.city.length;
    }

    remove(item) {
        var index = this.data.indexOf(item);
        this.data.splice(index, 1);
    }

}
