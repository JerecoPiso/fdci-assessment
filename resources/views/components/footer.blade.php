<script>
    const baseUrl = "{{ url('contacts') }}";
    $(document).on('click', '.delete-contact', function() {
        const contactId = $(this).data('id');
        if (confirm('Are you sure you want to delete this contact?')) {
            $.ajax({
                url: `${baseUrl}/${contactId}`,
                method: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $(`button[data-id="${contactId}"]`).closest('tr').remove();
                    alert('Contact deleted successfully')
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Error deleting contact.');
                }
            });
        }
    });
    function searchContacts(url) {
        const searchQuery = $('#searchInput').val();
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: searchQuery
            },
            success: function(data) {
                console.log(data)
                let contactsHtml = '';
                data.contacts.data.forEach(contact => {
                    contactsHtml += `
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   ${contact.name}
                                </th>
                                <td class="px-6 py-4">
                                  ${contact.company}
                                </td>
                                <td class="px-6 py-4">
                                    ${contact.phone}
                                </td>
                                <td class="px-6 py-4">
                                     ${contact.email}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="${baseUrl}/${contact.id}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    <button class="font-medium text-red-600 hover:underline delete-contact" data-id="${contact.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                });
                $('#contacts-list').html(contactsHtml);
                let paginationHtml = '';
                if (data.last_page > 1) {
                    paginationHtml += '<div class="pagination">';
                    for (let i = 1; i <= data.last_page; i++) {
                        paginationHtml += `<a href="#" class="page-link" data-page="${i}">${i}</a>`;
                    }
                    paginationHtml += '</div>';
                }
                $('#contacts-list').append(paginationHtml);

                $('#paginationLinks').html(data.links);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    $(document).ready(function() {
        const url = "{{ route('contacts.index') }}"
        searchContacts(url)
    });
    $(document).on('click', '#paginationLinks a', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        searchContacts(url)
    });
</script>
</body>

</html>