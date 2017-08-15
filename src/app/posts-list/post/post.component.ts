import {Component, Input, OnInit} from '@angular/core';
import {PostModel} from "../../models/post.model";
import {ImgDialogComponent} from "../../shared/img-dialog/img-dialog.component";
import {MdDialog} from "@angular/material";

@Component({
  selector: 'app-post',
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.css']
})
export class PostComponent implements OnInit {

  @Input() post: PostModel;
  postImg:string;


  constructor(private dialog: MdDialog) { }

  ngOnInit() {
    this.postImg = this.post.postImgArray[0].img64bitString;
  }
  onImgOpen(){
    console.log('onImgOpen')
    let dialog = this.dialog.open(ImgDialogComponent);

    dialog.afterClosed()
      .subscribe(selection => {
        if (selection) {
          console.log(selection)
        } else {
          // User clicked 'Cancel' or clicked outside the dialog
        }
      });

  }

}
