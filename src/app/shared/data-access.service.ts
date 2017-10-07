import {Subject} from "rxjs/Subject";
import {Http,Response} from "@angular/http";
import {Injectable} from "@angular/core";
import 'rxjs/Rx'



@Injectable()
export class DataAccessService{
  private userName:string = "Misha";
  private eMail:string = "M@m.com";
  private password:string="123qwe";
  userActivate = new Subject();
  test2:{};

  constructor(private http: Http){

  }



  loginUserNameAuthentication(userName:string , password:string){
    const  params= {
      email: userName,
      password: password
    };
    console.log(params);
    console.log('../phpAPI/users/login.php?',params);
    this.http.get('http://localhost/users/login.php',{params})
      /*.map(
        (response: Response) =>{
          const test:{} = response.json();
            console.log(test)
          return test;
          }

      )*/
      .subscribe((data ) => {
          console.log(data)
        }, error => {
          console.log('error');
        }
      );
  }
  loginEmailNameAuthentication(eMail:string , password:string){

  }

}
