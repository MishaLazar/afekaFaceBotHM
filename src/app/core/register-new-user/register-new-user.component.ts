import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-register-new-user',
  templateUrl: './register-new-user.component.html',
  styleUrls: ['./register-new-user.component.css']
})
export class RegisterNewUserComponent implements OnInit {

  userRegisterForm: FormGroup;
  constructor() { }

  ngOnInit() {
    this.formInit()
  }

  private formInit(){
    let userName = '';
    let userEmail = '';
    let userPassword= '';
    this.userRegisterForm = new FormGroup({
              'name': new FormControl(userName, Validators.required),
              'email': new FormControl(userEmail, Validators.required),
              'password': new FormControl(userPassword,Validators.required)
    });

  }

  onSubmit(){
    console.log(this.userRegisterForm.value);
  }

}
