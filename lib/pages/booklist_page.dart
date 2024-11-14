import 'package:flutter/material.dart';
import '../widgets/navigation_frame.dart';

class BooklistPage extends StatefulWidget {
  BooklistPage({super.key});
  @override
  State<BooklistPage> createState() => _BooklistPageState();
}

class _BooklistPageState extends State<BooklistPage> {
  @override
  Widget build(BuildContext context) {
    return NavigationFrame(
      selectedIndex: 2,
      child: Container(
          child: Text("Book List",
              textAlign: TextAlign.center,
              style: TextStyle(
                fontSize: 48,
                fontWeight: FontWeight.bold,
              ))),
    );
  }
}
