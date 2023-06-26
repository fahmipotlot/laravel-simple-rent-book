@extends('layouts.app')
 
@section('title', 'Soal 3')
 
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">Get Substring Unique Terpanjang</div>
            <div class="panel-body">
                <div class="control-group after-add-more">
                    <label>String</label>
                    <input type="text" id="str" name="str" class="form-control">
                </div>
                <br/>
                <button class="btn btn-success" id="submit" type="submit">Submit</button>
				<br/>
                <h3>Hasil</h3>
				<div class="hasil"></div>
			</div>
        </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#submit").click(function() {
            var lengthOfLongestSubstring = function (s) {
                // Base condition
                if (!s) {
                    return 0;
                }
                // Starting index of the window
                let start = 0;
                // Ending index of the window
                let end = 0;
                // Maximum length of the substring
                let maxLength = 0;
                // Set to store the unique characters
                const uniqueCharacters = new Set();
                // Loop for each character in the string
                while (end < s.length) {
                    if (!uniqueCharacters.has(s[end])) {
                        uniqueCharacters.add(s[end]);
                        end++;
                        maxLength = Math.max(maxLength, uniqueCharacters.size);
                    } else {
                        uniqueCharacters.delete(s[start]);
                        start++;
                    }
                }
                return maxLength;
            };

            var str = $('#str').val();
            var value = lengthOfLongestSubstring(str);
            
            $('.hasil').append('<li>'+str+' => '+value+'</li>');

            console.log(str);
            console.log(value);
        });
    });
</script>
@endpush