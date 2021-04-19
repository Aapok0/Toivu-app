function ToivuTheme(target) {
    if (target instanceof am4core.ColorSet) {
      target.list = [
        am4core.color("#BB8588"),
        am4core.color("#D8A48F")
      ];
    }
    if (target instanceof am4core.InterfaceColorSet) {
      target.setFor("background", am4core.color("#EFEBCE"));
    }
  }