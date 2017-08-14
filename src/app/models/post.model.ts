
import {ImageModel} from "./image.model";
import {LikeModel} from "./like.model";
import {CommentModel} from "./comment.model";

export class PostModel{
  public postId:number;
  public permission:string;
  public userId:number;
  public postComments : CommentModel[];
  public postCreationDate:Date;
  public postPublishDate:Date;
  public postLikesNumber:number; //counter
  public postImgArray:ImageModel[];
  public postLikesArray: LikeModel[];

  constructor(postId:number,permission:string,userId:number,
              postComments:CommentModel[],postCreationDate:Date,postPublishDate:Date,
              postLikesNumber:number,postImgArray:ImageModel[],postLikesArray:LikeModel[]){
    this.postId=postId;
    this.permission = permission;
    this.userId=userId;
    this.postComments = postComments;
    this.postCreationDate = postCreationDate;
    this.postPublishDate=postPublishDate;
    this.postLikesNumber = postLikesNumber;
    this.postImgArray = postImgArray;
    this.postLikesArray = postLikesArray;

  }



}
