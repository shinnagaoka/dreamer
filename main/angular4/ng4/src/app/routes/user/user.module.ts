import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SharedModule } from '../../shared/shared.module';
import { SigninComponent } from './signin/signin.component';
import { SignupComponent } from './signup/signup.component';
import { LockComponent } from './lock/lock.component';
import { RecoverComponent } from './recover/recover.component';

// const routes: Routes = [
//     { path: 'signin', component: SigninComponent },
//     { path: 'signup', component: SignupComponent },
//     { path: 'lock', component: LockComponent },
//     { path: 'recover', component: RecoverComponent },
// ];

@NgModule({
    imports: [
        SharedModule,
        // RouterModule.forChild(routes)
    ],
    declarations: [
        SigninComponent,
        SignupComponent,
        LockComponent,
        RecoverComponent
    ],
    exports: [
        RouterModule,
        SigninComponent,
        SignupComponent,
        LockComponent,
        RecoverComponent
    ]
})
export class UserModule { }