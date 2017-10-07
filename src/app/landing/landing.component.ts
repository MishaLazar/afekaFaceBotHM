import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent implements OnInit {
  private mainLogo = require("../shared/imgs/logo.jpg");

  constructor() { }

  ngOnInit() {
  }

}
