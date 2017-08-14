
export class CommentModel{

  public commentId:number;
  public postId:number;
  public commentUserId:number;
  public commentCreationDate:Date;
  public comment:string;

  constructor(commentId:number,postId:number,commentUserId:number,
              commentCreationDate:Date,comment:string){
    this.commentId = commentId;
    this.postId = postId;
    this.commentUserId = commentUserId;
    this.commentCreationDate = commentCreationDate;
    this.comment = comment;
  }
}
