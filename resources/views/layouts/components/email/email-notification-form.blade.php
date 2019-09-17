<div class="row">
   <div class="col-lg-12">
      <div class="form-group">
         <label class="col-lg-2 control-label">Reply To:</label>
         <div class="col-lg-10" style="margin-bottom: 10px;">     
            <input name="name" type="text" class="form-control txt-reply" placeholder="Enter receipt name" readonly value="{{$name}}">
         </div>
      </div>
      <div class="form-group">
         <label class="col-lg-2 control-label">Email:</label>
         <div class="col-lg-10" style="margin-bottom: 10px;">     
            <input name="email" type="email" class="form-control txt-reply-email" readonly placeholder="Enter Email" value="{{$email}}">
         </div>
      </div>
      <div class="form-group">
         <label class="col-lg-2 control-label">Subject:</label>
         <div class="col-lg-10" style="margin-bottom: 10px;">    
            <input name="subject" type="text" class="form-control txt-reply-subject" placeholder="Enter Subject" value="Happy Birthday {{$name}}!" required>
         </div>
      </div>
      <div class="form-group">
         <label class="col-lg-2 control-label">Message:</label>
         <div class="col-lg-10">    
            <textarea name="message" class="form-control input-title" placeholder="Enter Message" style="height:200px;" required>On your special day, we just wanted to let you know that we consider ourselves very lucky to have gotten the opportunity to work with you. We will readily admit that good customers like you are rare. Happy birthday!</textarea>
         </div>
      </div>
   </div>
</div>
            