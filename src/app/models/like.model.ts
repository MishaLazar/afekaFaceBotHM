
export class LikeModel{

  public likeId:number;
  public postId:number;
  public likeUserId:number;
  public likeCreationDate:Date;

  constructor(likeId:number,postId:number,likeUserId:number,likeCreationDate:Date){

    this.likeId = likeId;
    this.postId = postId;
    this.likeUserId = likeUserId;
    this.likeCreationDate = likeCreationDate;
  }
}
