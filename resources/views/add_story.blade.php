<x-admin-master>

@section('content')

<h1 class="m-4">Add a New Story or Poem</h1>
<br>
<div class="container">
    <div id="user_messages"></div>
    <div class="col-xs-12 card p-4">        
        <div>  
            <small class="lft">TITLE:</small>
            <input class="art_ttl" id="ttl1" type="text" maxlength="100"><br>    
            <button class="tc" onclick="execCmd('bold');" title="Bold"><i class="fa fa-bold fa-lg"></i></button>
            <button class="tc" onclick="execCmd('italic');" title="Italic"><i class="fa fa-italic fa-lg"></i></button>
            <button class="tc" onclick="execCmd('underline');" title="Underline"><i class="fa fa-underline fa-lg"></i></button>
            <button class="tc" onclick="execCmd('strikeThrough');" title="Strikethrough"><i class="fa fa-strikethrough fa-lg"></i></button>
            <button class="tc" onclick="execCmd('justifyLeft');" title="Justify Left"><i class="fa fa-align-left fa-lg"></i></button>
            <button class="tc" onclick="execCmd('justifyCenter');" title="Justify Centre"><i class="fa fa-align-center fa-lg"></i></button>
            <button class="tc" onclick="execCmd('justifyRight');" title="Justify Right"><i class="fa fa-align-right fa-lg"></i></button>
            <button class="tc" onclick="execCmd('cut');" title="Cut"><i class="fa fa-cut fa-lg"></i></button>
            <button class="tc" onclick="execCmd('copy');" title="Copy"><i class="fa fa-copy fa-lg"></i></button>
            <button class="tc" onclick="execCmd('paste');" title="Paste"><i class="fa fa-paste fa-lg"></i></button>
            <button class="tc" onclick="execCmd('indent');" title="Increase Indent"><i class="fa fa-indent fa-lg"></i></button>
            <button class="tc" onclick="execCmd('outdent');" title="Decrease Indent"><i class="fa fa-dedent fa-lg"></i></button>
            <button class="tc" onclick="execCmd('insertUnorderedList');" title="Bullet List"><i class="fa fa-list-ul fa-lg"></i></button>
            <button class="tc" onclick="execCmd('insertOrderedList');" title="Numbered List"><i class="fa fa-list-ol fa-lg"></i></button>
            <button class="tc" onclick="execCmd('insertParagraph');" title="Insert Paragraph"><i class="fa fa-paragraph fa-lg"></i></button>
            <button class="tc" onclick="execCmd('undo');" title="Undo"><i class="fa fa-undo fa-lg"></i></button>
            <button class="tc" onclick="execCmd('redo');" title="Redo"><i class="fa fa-repeat fa-lg"></i></button>
            <button class="tc" onclick="execCmd('insertHorizontalRule');" title="Horizontal Rule">HR</button>
            <button class="tc" onclick="execCmdArg('fontSize', '7');" title="Large Text"><b>L</b></button>
            <button class="tc" onclick="execCmdArg('fontSize', '5');" title="Medium Text"><b>M</b></button>
            <button class="tc" onclick="execCmdArg('fontSize', '3');" title="Small text"><b>S</b></button>
            <button class="tc" onclick="execCmdArg('hiliteColor', '#ffff00');" title="Highlight Text"><i class="fa fa-paint-brush"></i></button>
            <button class="tc" onclick="execCmdArg('hiliteColor', 'rgba(0,0,0,0)');" title="Remove Highlight"><i class="fa fa-close"></i></button>
            <button class="tc" onclick="execCmdArgs('insertImage', prompt('Enter the image URL', ''));" title="Insert Image"><i class="fa fa-image"></i></button>
            <button class="tc" onclick="execCmdArg('createLink', prompt('Enter a URL', 'http://'));" title="Create Link"><i class="fa fa-link"></i></button>
            <button class="tc" onclick="execCmd('unLink');" title="Unlink"><i class="fa fa-unlink"></i></button>
            <select onchange="execCmdArg('fontName', this.value);">
                <option value="Arial"> Arial </option>
                <option value="Comic Sans MS"> Comic Sans MS </option>
                <option value="Courier"> Courier </option>
                <option value="Georgia"> Georgia </option>
                <option value="Tahoma"> Tahoma </option>
                <option value="Times New Roman"> Times New Roman </option>
                <option value="Verdana"> Verdana </option>
            </select>
            <br>
            <small class="lft">CONTENT:</small>
            <div class="art_cnt" contenteditable></div>
            <br>
            <button onclick="saveToDB()" class="btn btn-info"> <i class="fa fa-save fa-lg"></i> Save </button>
            <br>
        </div>
    </div>




</div>
<br><br>
<script>
    function execCmd(command){
        document.execCommand(command, false, null);
    }
    function execCmdArg(command, arg){
        document.execCommand(command, false, arg);
    }

    function saveToDB(){
        var title1 = document.getElementById("ttl1").value;
        var content1 = $('.art_cnt').html(); 
        var url1 = '{{route('store.story')}}';
            $.ajax({
                url: url1,
                type: "POST",
                data: {
                "_token": "{{ csrf_token() }}",
                "title1": title1,
                "content1": content1,
                },              
                success:function (data) {
                    //Display Confirmation to user
                    document.getElementById("user_messages").innerHTML = "Saved Successfully";
                    window.setTimeout(function(){
                    window.location.href = "mystories";
                    }, 1000);
                }, error: function (data){
                    console.log(data);
                }
            });   

    };        
</script>
@endsection


</x-admin-master>