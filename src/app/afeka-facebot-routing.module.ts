
import {LandingComponent} from "./landing/landing.component";
import {NgModule} from "@angular/core";
import {RouterModule} from "@angular/router";
import {PostsListComponent} from "./posts-list/posts-list.component";


const afekabotRoutes = [
  { path:'', component:LandingComponent},
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
