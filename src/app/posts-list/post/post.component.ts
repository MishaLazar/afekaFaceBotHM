import {Component, Input, OnInit} from '@angular/core';
import {PostModel} from "../../models/post.model";

@Component({
  selector: 'app-post',
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.css']
})
export class PostComponent implements OnInit {

  @Input() post: PostModel;
  postImg:string;



  constructor() { }

  ngOnInit() {

  }
  onImgOpen(){
    /*let config = new MdDialogConfig();
    config = {
      disableClose: false,
      width: '50%',
      height: '50%',
      position: {
        top: '50%',
        bottom: '50%',
        left: '50%',
        right: '50%'

      }

    }*/


  }

}
