import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DataTableModule } from "angular2-datatable";
import { NgxDatatableModule } from '@swimlane/ngx-datatable';

import { SharedModule } from '../../shared/shared.module';
import { ClassicComponent } from './classic/classic.component';
import { DatatablesComponent } from './datatables/datatables.component';
import { DataFilterPipe } from './datatables/datafilter.pipe';
import { ResponsiveComponent } from './responsive/responsive.component';
import { NgxdatatableComponent } from './ngxdatatable/ngxdatatable.component';

const routes: Routes = [
    { path: 'classic', component: ClassicComponent },
    { path: 'responsive', component: ResponsiveComponent },
    { path: 'datatables', component: DatatablesComponent },
    { path: 'ngxdatatable', component: NgxdatatableComponent },
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes),
        DataTableModule,
        NgxDatatableModule
    ],
    declarations: [
        ClassicComponent,
        DatatablesComponent,
        DataFilterPipe,
        ResponsiveComponent,
        NgxdatatableComponent
    ],
    providers: [
        DataFilterPipe
    ],
    exports: [
        RouterModule
    ]
})
export class TablesModule { }