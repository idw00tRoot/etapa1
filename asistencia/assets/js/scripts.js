$(document).ready(function(){
                    // When a category is selected, load the series for that category
                    $('#category-select').change(function() {
                        var categoryId = $(this).val();
                        $.ajax({
                            url: '../pages/load_series.php',
                            type: 'POST',
                            data: { category_id: categoryId },
                            success: function(response) {
                                $('#series-select').html(response);
                            }
                        });
                    });

                    // When a series is selected, load the students for that series
                    $('#series-select').change(function() {
                        var seriesId = $(this).val();
                        $.ajax({
                            url: '../pages/load_students.php',
                            type: 'POST',
                            data: { series_id: seriesId },
                            success: function(response) {
                                $('#student-list').html(response);
                            }
                        });
                    });

                    // Mark attendance with AJAX
                    $(document).on('click', '.attendance-btn', function() {
                        var studentId = $(this).data('id');
                        var attendanceStatus = $(this).data('status');
                        $.ajax({
                            url: '../pages/mark_attendance.php',
                            type: 'POST',
                            data: { student_id: studentId, status: attendanceStatus },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Éxito!',
                                    text: 'Asistencia marcada correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    });
                });