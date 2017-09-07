import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FileUploadModule } from 'ng2-file-upload';
import { ColorPickerModule, ColorPickerService } from 'ngx-color-picker';
import { SelectModule } from 'ng2-select';

import { SharedModule } from '../../shared/shared.module';
import { StandardComponent } from './standard/standard.component';
import { ValidationComponent } from './validation/validation.component';
import { AdvancedComponent } from './advanced/advanced.component';
import { SummernoteComponent } from './summernote/summernote.component';
import { DropzoneComponent } from './dropzone/dropzone.component';
import { WizardComponent } from './wizard/wizard.component';
import { TypeaheadComponent } from './typeahead/typeahead.component';

const routes: Routes = [
    { path: 'standard', component: StandardComponent },
    { path: 'validation', component: ValidationComponent },
    { path: 'advanced', component: AdvancedComponent },
    { path: 'summernote', component: SummernoteComponent },
    { path: 'dropzone', component: DropzoneComponent },
    { path: 'wizard', component: WizardComponent },
    { path: 'typeahead', component: TypeaheadComponent }
];

@NgModule({
    imports: [
        SharedModule,
        RouterModule.forChild(routes),
        FileUploadModule,
        SelectModule,
        ColorPickerModule
    ],
    providers: [
        ColorPickerService
    ],
    declarations: [
        StandardComponent,
        ValidationComponent,
        AdvancedComponent,
        SummernoteComponent,
        DropzoneComponent,
        WizardComponent,
        TypeaheadComponent
    ],
    exports: [
        RouterModule
    ]
})
export class FormsModule { }