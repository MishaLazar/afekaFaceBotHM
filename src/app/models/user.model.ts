
export class UserModel{
  public userId: number;
  public userName:string;
  public userEmail:string;
  public userPassword : string;
  public userFriendsArray: UserModel [];

  constructor(userId:number, userName:string, userEmail:string, userPassword:string,
              userFreindsArray:UserModel[]){
    this.userId = userId;
    this.userName = userName;
    this.userEmail = userEmail;
    this.userPassword = userPassword;
    this.userFriendsArray = userFreindsArray

  }
}
