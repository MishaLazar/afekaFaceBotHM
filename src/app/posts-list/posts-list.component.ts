import { Component, OnInit } from '@angular/core';
import {PostModel} from "../models/post.model";
import {PostListSvcService} from "./post-list-svc.service";

@Component({
  selector: 'app-posts-list',
  templateUrl: './posts-list.component.html',
  styleUrls: ['./posts-list.component.css']
})
export class PostsListComponent implements OnInit {


  posts: PostModel[];

  constructor(private postListSVC:PostListSvcService ) {

  }

  ngOnInit() {
    this.posts = this.postListSVC.getPosts();
  }

}
