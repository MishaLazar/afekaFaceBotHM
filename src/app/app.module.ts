import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import {HeaderComponent} from "./core/header/header.component";
import {DropdownDirective} from "./shared/dropdown.directive";
import {ReactiveFormsModule} from "@angular/forms";
import {RegisterNewUserComponent} from "./core/register-new-user/register-new-user.component";
import {AfekaFacebotRoutingModule} from "./afeka-facebot-routing.module";
import {PostListSvcService} from "./posts-list/post-list-svc.service";
import {PostsListComponent} from "./posts-list/posts-list.component";
import {PostComponent} from "./posts-list/post/post.component";
import {MdDialogModule} from "@angular/material";
import {ImgDialogComponent} from "./shared/img-dialog/img-dialog.component";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LandingComponent,
    DropdownDirective,
    RegisterNewUserComponent,
    PostsListComponent,
    PostComponent,
    ImgDialogComponent

  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    AfekaFacebotRoutingModule,
    MdDialogModule,
    BrowserAnimationsModule
  ],
  entryComponents:[ImgDialogComponent],
  providers: [PostListSvcService],
  bootstrap: [AppComponent]
})
export class AppModule { }
