import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import {HeaderComponent} from "./core/header/header.component";
import {DropdownDirective} from "./shared/dropdown.directive";
import {ReactiveFormsModule} from "@angular/forms";
import {RegisterNewUserComponent} from "./landing/register-new-user/register-new-user.component";
import {AfekaFacebotRoutingModule} from "./afeka-facebot-routing.module";
import {PostListSvcService} from "./posts-list/post-list-svc.service";
import {PostsListComponent} from "./posts-list/posts-list.component";
import {PostComponent} from "./posts-list/post/post.component";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {LoginUserComponent} from "./landing/login-user/login-user.component";
import {LandingLoginComponent} from "./landing/landing-login/landing-login.component";
import {DataAccessService} from "./shared/data-access.service";
import {HttpModule} from "@angular/http";





@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LandingComponent,
    LandingLoginComponent,
    DropdownDirective,
    RegisterNewUserComponent,
    PostsListComponent,
    PostComponent,
    LoginUserComponent




  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    AfekaFacebotRoutingModule,
    BrowserAnimationsModule,
    HttpModule
  ],
  entryComponents:[],
  providers: [PostListSvcService,DataAccessService],
  bootstrap: [AppComponent]
})
export class AppModule { }
