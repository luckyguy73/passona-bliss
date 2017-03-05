<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="category" class="control-label">Category</label>
    <select name="category_id" id="category" class="form-control"{{ isset($listing) && $listing->live() ? ' disabled' : '' }}>
        @foreach($categories as $category)
            <optgroup label="{{ $category->name }}">
                @foreach($category->children as $child)
                    
                    @if(isset($listing) && $listing->category_id == $child->id  || old('category_id') == $child->id)
                        <option value="{{ $child->id }}" selected>{{ $child->name }}</option>
                    @else
                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                    @endif
                    
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @if($errors->has('category_id'))
        <span class="help-block">
            <strong>{{ $errors->first('category_id') }}</strong>
        </span>
    @endif
</div>