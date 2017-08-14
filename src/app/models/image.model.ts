
export class ImageModel{
  public imageId:number;
  public postId:number;
  public imageUploadingDate:Date;
  public img64bitString:string;

  constructor(imageId:number,postId:number,
              imageUploadingDate:Date, img64bitString:string){
    this.imageId = imageId;
    this.postId = postId;
    this.imageUploadingDate = imageUploadingDate;
    this.img64bitString = img64bitString;

}
}
