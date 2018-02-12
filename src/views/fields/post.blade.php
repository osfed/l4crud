<div class="form-group">
    <label for="field_<?php echo $key ?>"><?php echo $field['title']?></label>
	@if($raw->getState() == 'view')
		<div class="Post">			
			@if(isset($raw->item->$key))
				{{$raw->item->$key}}				
			@endif
		</div>
	@else
		<div class="Post">
			<div class="input is-hidden">
				@if(isset($raw->item->$key))					
					<textarea name="{{$key}}" id="dato-post" value="{{$raw->item->$key}}"></textarea>
				@else
					<textarea name="{{$key}}" id="dato-post"></textarea>
				@endif
			</div>
			<div class="NewPost" data-action="{{Route('rawUploadImages')}}" data-remove="{{Route('rawRemoveImages')}}">
				@if(isset($raw->item->$key))
					{{$raw->item->$key}}				
				@endif	
			</div>
		</div>
	@endif
</div>