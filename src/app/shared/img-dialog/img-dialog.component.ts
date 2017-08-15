import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-img-dialog',
  templateUrl: './img-dialog.component.html',
  styleUrls: ['./img-dialog.component.css']
})
export class ImgDialogComponent implements OnInit {

  img:string;
  constructor() { }

  ngOnInit() {
    this.img='https://dw9to29mmj727.cloudfront.net/misc/newsletter-naruto3.png';
  }

}
