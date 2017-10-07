
import {NgModule} from "@angular/core";
import {RouterModule} from "@angular/router";
import {LandingComponent} from "./landing/landing.component";
import {PostsListComponent} from "./posts-list/posts-list.component";
import {LandingLoginComponent} from "./landing/landing-login/landing-login.component";


const afekabotRoutes = [
  { path:'', component:LandingComponent},
  { path:'login', component:LandingLoginComponent},
  { path:'posts',component: PostsListComponent }
];

@NgModule({
  imports:[
    RouterModule.forRoot(afekabotRoutes)
  ],
  exports:[RouterModule]
})
export class AfekaFacebotRoutingModule{


}
