import 'package:flutter/material.dart';
import 'pages/home_page.dart';
import 'pages/add_book_page.dart';
import 'pages/booklist_page.dart';

void main() => runApp(App());

class App extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        title: 'EEE4482 e-Library',
        initialRoute: '/',
        routes: {
          '/': (context) => HomePage(),
          '/home': (context) => HomePage(),
          '/add': (context) => AddBookPage(),
          '/booklist': (context) => BooklistPage(),
        },
        theme: ThemeData(
          useMaterial3: true,
          colorSchemeSeed: Color.fromARGB(255, 207, 183, 105),
        ));
  }
}
