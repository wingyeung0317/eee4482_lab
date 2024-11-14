import 'package:flutter/material.dart';

class InputBox extends StatefulWidget {
  final String name;
  final String hint;
  final TextEditingController controller;
  final bool obscureText;
  InputBox(
      {super.key,
      required this.name,
      required this.hint,
      required this.controller,
      this.obscureText = false});
  @override
  State<InputBox> createState() => _InputBoxState();
}

class _InputBoxState extends State<InputBox> {
  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Container(
          margin: EdgeInsets.only(left: 20, top: 10, bottom: 10, right: 20),
          child: Text(
            widget.name,
            style: TextStyle(fontSize: 14, fontWeight: FontWeight.bold),
          ),
        ),
        Container(
            margin: EdgeInsets.only(left: 20, top: 0, bottom: 10, right: 20),
            alignment: Alignment.centerLeft,
            child: TextFormField(
              obscureText: widget.obscureText,
              controller: widget.controller,
              decoration: InputDecoration(
                border: OutlineInputBorder(),
                labelText: widget.hint,
              ),
            )),
      ],
    );
  }
}
