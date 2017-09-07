import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SharedModule } from '../../shared/shared.module';
import { BootstrapuiComponent } from './bootstrapui/bootstrapui.component';
import { ButtonsComponent } from './buttons/buttons.component';
import { ColorsComponent } from './colors/colors.component';
import { GridComponent } from './grid/grid.component';
import { IconsComponent } from './icons/icons.component';
import { NestableComponent } from './nestable/nestable.component';
import { SpinnersComponent } from './spinners/spinners.component';
import { SweetalertComponent } from './sweetalert/sweetalert.component';
import { TypographyComponent } from './typography/typography.component';
import { UtilitiesComponent } from './utilities/utilities.component';
import { ModalsComponent } from './modals/modals.component';
import { ToasterComponent } from './toaster/toaster.component';
import { GridmasonryComponent } from './gridmasonry/gridmasonry.component';
import { ToasterModule, ToasterService } from 'angular2-toaster';

const routes: Routes = [
    { path: 'bootstrapui', component: BootstrapuiComponent },
    { path: 'buttons', component: ButtonsComponent },
    { path: 'colors', component: ColorsComponent },
    { path: 'grid', component: GridComponent },
    { path: 'icons', component: IconsComponent },
    { path: 'modals', component: ModalsComponent },
    { path: 'nestable', component: NestableComponent },
    { path: 'spinners', component: SpinnersComponent },
    { path: 'sweetalert', component: SweetalertComponent },
    { path: 'typography', component: TypographyComponent },
    { path: 'utilities', component: UtilitiesComponent },
    { path: 'gridmasonry', component: GridmasonryComponent },
    { path: 'toaster', component: ToasterComponent }
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes),
        ToasterModule
    ],
    declarations: [
        BootstrapuiComponent,
        ButtonsComponent,
        ColorsComponent,
        GridComponent,
        IconsComponent,
        NestableComponent,
        SpinnersComponent,
        SweetalertComponent,
        TypographyComponent,
        UtilitiesComponent,
        ModalsComponent,
        ToasterComponent,
        GridmasonryComponent
    ],
    providers: [ToasterService],
    exports: [
        RouterModule
    ]
})
export class ElementsModule { }
