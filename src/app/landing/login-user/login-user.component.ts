import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {DataAccessService} from "../../shared/data-access.service";

@Component({
  selector: 'app-login-user',
  templateUrl: './login-user.component.html',
  styleUrls: ['./login-user.component.css']
})
export class LoginUserComponent implements OnInit {

  userLoginForm:FormGroup;

  constructor(private svcDAL:DataAccessService ) { }

  ngOnInit() {
    this.formInit();
  }

  private formInit(){
    let userName = '';
    let userPassword= '';
    this.userLoginForm = new FormGroup({
      'name': new FormControl(userName, Validators.required),
      'password': new FormControl(userPassword,Validators.required)
    });

  }

  onLogin(){
    console.log('onLogin()'+this.userLoginForm.value.name+'   '+this.userLoginForm.value.password);
    this.svcDAL.loginUserNameAuthentication(this.userLoginForm.value.name,this.userLoginForm.value.password);
  }
  onCancel(){

  }

}
