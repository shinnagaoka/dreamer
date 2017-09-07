import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SharedModule } from '../../../shared/shared.module';

import { Error404Component } from './error404/error404.component';
import { Error403Component } from './error403/error403.component';
import { Error500Component } from './error500/error500.component';
import { Error503Component } from './error503/error503.component';

const routes: Routes = [
    { path: '404', component: Error404Component },
    { path: '403', component: Error403Component },
    { path: '500', component: Error500Component },
    { path: '503', component: Error503Component },
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes)
    ],
    declarations: [
        Error404Component,
        Error403Component,
        Error500Component,
        Error503Component
    ],
    exports: [
        RouterModule
    ]
})
export class ErrorsModule { }
