<x-layout>
    <div class="container mx-auto my-8">
        
        <form id="record-form" class="grid gap-2 my-8">
            <h1 class="text-xl">Create record</h1>
            @csrf
            <div class="grid">
                <label for="full-name-input">Full name</label>
                <input class="border rounded-lg p-2" id="full-name-input" type="text" name="fullName" placeholder="Full name">
            </div>
            <div class="grid">
                <label for="comment-textarea">Comment</label>
                <textarea name="comment" id="comment-textarea" class="border rounded-lg p-2" placeholder="Your comment"></textarea>
            </div>
            <div>
                <button class=" bg-blue-500 text-white p-2 rounded-lg font-bold">POST</button>
            </div>
        </form>
    
        <h1 class="text-xl my-4">Records</h1>
        <div class=" grid gap-2 max-w-xl mx-auto" id="records-list"></div>
    </div>

    <script>
        $(document).ready(() => {
            $('#record-form').submit((e) => {
                e.preventDefault()
                $.ajax({
                    url: "{{ route('records.store') }}",
                    type: "POST",
                    data: $('#record-form').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        console.log('Entry added successfully:', data);
                        getRecords()
                    },
                    error: function (xhr, status, error) {
                        console.error('Error adding entry:', error);
                        console.log($('#record-form').serialize());

                    }
                });
            })

            $(document).on('click', '.delete-record', (e) => {
                e.preventDefault()
                var id = $(e.target).data('id')
                $(e.target).prop('disabled', true);
                $.ajax({
                    url: '/api/records/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        getRecords();
                        console.log('Entry deleted successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting entry:', error);
                        $(e.target).prop('disabled', false);
                    }
                });
                
            })

            function getRecords() {
                $.ajax({
                    url: "{{ route('records.index') }}",
                    type: "GET",
                    dataType: 'json',
                    success: ({ data }) => {
                        $('#records-list').html('')
                        console.log(data);
                        $.each(data, function (i, record) {
                            content = `
                                <div class="flex justify-between">
                                    <span>${record.fullName}</span>
                                    <button data-id="${record.id}" class=" delete-record bg-red-500/50 disabled:bg-red-500/20 disabled:cursor-progress p-2 rounded-lg font-bold">Delete</button>
                                </div>`;
                            content += `<div>${record.comment}</div>`
                            let html = `<div class="bg-slate-200 p-2 rounded-lg">${content}</div>`
                            $(html).appendTo("#records-list");
                        });
                    },
                    error: (data) => {
                        console.error(data);
                    }
                })
            }

            getRecords()
        })
    </script>
</x-layout>