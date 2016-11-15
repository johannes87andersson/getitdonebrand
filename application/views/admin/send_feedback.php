<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="/admin/doSendFeedback" method="POST">
                <div class="form-group">
                    <label for="feedback_subject">Ämne</label>
                    <input type="text" class="form-control" id="feedback_subject" name="feedback_subject" placeholder="Vad handlar det om">
                </div>
                <div class="form-group">
                    <label for="feedback_text">Beskrivning</label>
                    <textarea class="form-control" id="feedback_text" name="feedback_text" placeholder="Beskrivning"></textarea>
                </div>
                <button type="submit" class="btn btn-success pull-left">Submit</button>
            </form>
        </div>
    </div>
</div>