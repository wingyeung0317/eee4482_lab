import 'package:flutter/material.dart';
import '../widgets/input_box.dart';

class BookForm extends StatefulWidget {
  final int mode;
  final int bookId;
  const BookForm({super.key, required this.mode, this.bookId = 0});
  @override
  State<BookForm> createState() => _BookFormState();
}

class _BookFormState extends State<BookForm> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _titleController = TextEditingController();
  final TextEditingController _authorsController = TextEditingController();
  final TextEditingController _publishersController = TextEditingController();
  final TextEditingController _dateController = TextEditingController();
  final TextEditingController _isbnController = TextEditingController();
  @override
  Widget build(BuildContext context) {
    return Form(key: _formKey, child: _buildWidgets(context));
  }

  Widget _buildWidgets(BuildContext context) {
    return Column(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          InputBox(
            name: "Title",
            hint: "e.g. Harry Potter and the Philosopher's Stone",
            controller: _titleController,
          ),
          InputBox(
            name: "Authors",
            hint: "e.g. J. K. Rowling",
            controller: _authorsController,
          ),
          InputBox(
            name: "Publishers",
            hint: "e.g. Bloomsbury (UK)",
            controller: _publishersController,
          ),
          InputBox(
            name: "Date",
            hint: "e.g. 26 June 1997",
            controller: _dateController,
          ),
          InputBox(
            name: "ISBN",
            hint: "e.g. 978-0-7475-3269-9",
            controller: _isbnController,
          ),
          Container(
              margin: EdgeInsets.only(left: 20, top: 10, bottom: 10, right: 20),
              alignment: Alignment.centerLeft,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                    minimumSize: const Size.fromHeight(50),
                    textStyle: const TextStyle(fontSize: 14)),
                onPressed: () {
                  if (widget.mode == 0) {
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(
                          content:
                              Text("Added " + _titleController.text + ".")),
                    );
                  } else {
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(
                          content:
                              Text("Updated " + _titleController.text + ".")),
                    );
                  }
                },
                child: const Text('Submit'),
              )),
        ]);
  }
}
