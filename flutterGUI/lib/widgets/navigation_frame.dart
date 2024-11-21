import 'package:flutter/material.dart';

class NavigationFrame extends StatefulWidget {
  Widget child;
  int selectedIndex = 0;
  NavigationFrame(
      {super.key, required this.child, required this.selectedIndex});
  @override
  State<NavigationFrame> createState() => _NavigationFrameState();
}

class _NavigationFrameState extends State<NavigationFrame> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Row(children: [
      NavigationRail(
        backgroundColor: Colors.grey.shade100,
        selectedIndex: widget.selectedIndex,
        groupAlignment: -1.0,
        onDestinationSelected: (int index) {
          setState(() {
            widget.selectedIndex = index;
            switch (index) {
              case 0:
                Navigator.of(context).pushNamed("/home");
                break;
              case 1:
                Navigator.of(context).pushNamed("/add");
                break;
              case 2:
                Navigator.of(context).pushNamed("/booklist");
                break;
              default:
                Navigator.of(context).pushNamed("/");
            }
          });
        },
        labelType: NavigationRailLabelType.all,
        destinations: const <NavigationRailDestination>[
          NavigationRailDestination(
            icon: Icon(Icons.home_outlined),
            selectedIcon: Icon(Icons.home),
            label: Text('Home'),
          ),
          NavigationRailDestination(
            icon: Icon(Icons.my_library_add_outlined),
            selectedIcon: Icon(Icons.my_library_add),
            label: Text('Add Book'),
          ),
          NavigationRailDestination(
            icon: Icon(Icons.library_books_outlined),
            selectedIcon: Icon(Icons.library_books),
            label: Text('Book List'),
          ),
          NavigationRailDestination(
            icon: Icon(Icons.logout_outlined),
            selectedIcon: Icon(Icons.logout),
            label: Text('Logout'),
          ),
        ],
      ), //Container 1
      Expanded(child: Center(child: widget.child))
    ]));
  }
}
