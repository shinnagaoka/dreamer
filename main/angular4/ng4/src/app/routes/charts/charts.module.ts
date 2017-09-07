import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SharedModule } from '../../shared/shared.module';
import { RadialComponent } from './radial/radial.component';
import { FlotComponent } from './flot/flot.component';
import { PeityComponent } from './peity/peity.component';

const routes: Routes = [
    { path: 'radial', component: RadialComponent },
    { path: 'flot', component: FlotComponent },
    { path: 'peity', component: PeityComponent }
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes)
    ],
    declarations: [
        RadialComponent,
        FlotComponent,
        PeityComponent
    ],
    exports: [
        RouterModule
    ]
})
export class ChartsModule { }
