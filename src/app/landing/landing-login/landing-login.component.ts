import {Component,OnInit} from "@angular/core";
import {DataAccessService} from "../../shared/data-access.service";
@Component({
  selector: 'app-landing-login',
  templateUrl: './landing-login.component.html',
  styleUrls: ['./landing-login.component.css']
})
export class LandingLoginComponent{



  private mainLogo = require("../../shared/imgs/logo.jpg");
  constructor(private dalSVC:DataAccessService){

  }
  ngOnInit() {
  }

}
